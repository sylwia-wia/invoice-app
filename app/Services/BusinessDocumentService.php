<?php

namespace App\Services;

use App\Exceptions\BusinessDocumentException;
use App\Models\BusinessDocument;
use App\Models\DocumentPosition;
use Throwable;

class BusinessDocumentService
{
    /**
     * @throws BusinessDocumentException
     * @throws Throwable
     */
    public function create(array $attributes): BusinessDocument
    {
        /** @var DocumentPosition[] $positions */

        $positions = [];


        foreach ($attributes['position'] as $positionData) {
            $position = new DocumentPosition();
            $position->fill($positionData);
            $positions[] = $position;
        }


        $businessDocument = new BusinessDocument();
        $businessDocument->fill($attributes['document']);

        $dateValue = new \DateTime($businessDocument->sale_date);
        $year = $dateValue->format('Y');
        $month = $dateValue->format('m');
        $search = "$year/$month";

        $currentNumber = BusinessDocument::where('number', 'like', "%$search%" )->get()->last()->number ?? null;

        if ($currentNumber === null) {
            $nextDocNumber = 1;
        } else {
            $nextDocNumber = (int) explode('/', $currentNumber)[2] + 1;
        }

        $businessDocument->number = sprintf("%d/%02d/%02d", $year, $month, $nextDocNumber);

        $this->calculateValues($businessDocument, $positions);

        \DB::beginTransaction();

       try {
            $businessDocument->save();
            $businessDocument->positions()->saveMany($positions);
        } catch (\Exception) {
            \DB::rollBack();

            throw new BusinessDocumentException('Wystąpił błąd zapisu faktury do systemu.');
      }

        \DB::commit();

        return $businessDocument;
    }

    public function update(array $attributes, $id):BusinessDocument
    {
        /** @var BusinessDocument $businessDocument */
        $businessDocument = BusinessDocument::findOrFail($id);
        $positions = $businessDocument->positions;

        \DB::beginTransaction();

        $updatedPositionIDs = array_keys($attributes['position']);
        $existedPositionIDs = array_column($positions->toArray(), 'id');
        $positionsIdsToDelete = array_diff($existedPositionIDs, $updatedPositionIDs);
        if ($positionsIdsToDelete !== []) {
            $businessDocument->positions()
                ->whereIn('id', $positionsIdsToDelete)
                ->delete();
        }

        $changedPositions = [];
        foreach ($attributes['position'] as $positionID => $positionData) {
            $position = $positions->first(fn(DocumentPosition $position) =>
                $position->id === $positionID
            );

            if ($position === null) {
                $position = new DocumentPosition();
                $position->business_document_id = $businessDocument->id;
            }

            $position->fill($positionData);
            $position->save();
            $changedPositions[] = $position;
        }

        $this->calculateValues($businessDocument, $changedPositions);
        $businessDocument->update($attributes['document']);

        \DB::commit();
        return $businessDocument;

    }

    /**
     * @param DocumentPosition[] $positions
     */
    private function calculateValues(BusinessDocument $document, array $positions): void
    {
        $document->net_value = 0;
        $document->vat_value = 0;
        $document->gross_value = 0;

        foreach ($positions as $position) {
            $positionNetValue = $position->net_price * $position->quantity;
            $positionVatValue = $positionNetValue * $position->vatRate->rate / 100;

            $document->net_value += $positionNetValue;
            $document->vat_value += $positionVatValue;
            $document->gross_value += $positionNetValue + $positionVatValue;
        }
    }

    public function calculateSettlement(array $attributes, $id)
    {
        $businessDocument = BusinessDocument::findOrFail($id);
        dd($businessDocument);

    }

}
