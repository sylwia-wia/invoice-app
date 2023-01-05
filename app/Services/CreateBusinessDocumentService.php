<?php

namespace App\Services;

use App\Exceptions\CreateBusinessDocumentException;
use App\Models\BusinessDocument;
use App\Models\DocumentPosition;

class CreateBusinessDocumentService
{
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

        $this->calculateValues($businessDocument, $positions);

        \DB::beginTransaction();

        try {
            $businessDocument->save();
            $businessDocument->position()->saveMany($positions);
        } catch (\Exception) {
            \DB::rollBack();

            throw new CreateBusinessDocumentException('Wystąpił błąd zapisu faktury do systemu.');
        }

        \DB::commit();

        return $businessDocument;
    }

    /**
     * @param DocumentPosition[] $positions
     */
    private function calculateValues(BusinessDocument $document, array $positions): void
    {
        foreach ($positions as $position) {
            $positionNetValue = $position->net_price * $position->quantity;
            $positionVatValue = $positionNetValue * $position->vatRate->rate / 100;

            $document->net_value += $positionNetValue;
            $document->vat += $positionVatValue;
            $document->gross_value += $positionNetValue + $positionVatValue;
        }
    }

}
