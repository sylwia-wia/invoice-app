import './bootstrap';
import "bootstrap-icons/font/bootstrap-icons.css";
import Alpine from "alpinejs";

const modalInvokers = document.getElementsByClassName("show-modal");
for (const modalInvoker of modalInvokers) {
    modalInvoker.addEventListener("click", showMainModal);
}

function showMainModal(e) {
    const modalElement = document.getElementById("mainModal");
    const modal = new bootstrap.Modal(modalElement);
    const modalContent = modalElement.getElementsByClassName("modal-body")[0];
    axios.get(this.dataset.url)
        .then (res => {
            modalContent.innerHTML = res.data;
            modal.show();
        });

    // modal.show();
}

function businessDocumentData(initialState) {
    const initialPositionState = {
        price: '',
        vatRate: '',
        unit: '',
        quantity: 0,
        vatValue: 0,
        grossValue: 0,
        product: '',
        sumNetValue: 0,
        sumVatValue: 0,
        sumGrossValue: 0
    };

    return {
        positions: {},

        init() {
            if (!initialState) {
                this.positions[0] = {...initialPositionState};
                return;
            }

            initialState.forEach(state => {
                this.positions[state.id] = {
                    price: state.net_price,
                    vatRate: state.vat_rate_id,
                    vatValue: state.vat_value,
                    unit: state.unit_id,
                    quantity: state.quantity,
                    grossValue: state.gross_value,
                    product: state.product_id,
                }
            })
        },

        createNewPosition() {
            const nextKey = Math.max(...Object.keys(this.positions)) + 1;
            this.positions[nextKey] = {
                ...initialPositionState
            };
        },

        removePosition(index) {
            delete this.positions[index];
        },

        getProductDataFromApi(event, index) {
            axios.get(`/products/${event.target.value}/json`)
                .then((res) => {
                    this.positions[index].price = res.data.price;
                    this.positions[index].vatRate = res.data.vat_rate_id;
                    this.positions[index].unit = res.data.unit_id;
                })
        },

        calculateTaxes(index) {
            if (this.positions[index].price === '' || this.positions[index].vatRate === '' || this.positions[index].quantity === 0) {
                return;
            }

            const vatRateValue = JSON.parse(VAT_RATES).filter(vatRate => vatRate.id === parseInt(this.positions[index].vatRate))[0].rate;
            const netValue = parseFloat(this.positions[index].price) * parseFloat(this.positions[index].quantity);

            this.positions[index].vatValue = (netValue * (vatRateValue) / 100);
            this.positions[index].vatValue = parseFloat(this.positions[index].vatValue).toFixed(2);
            this.positions[index].grossValue = netValue + parseFloat(this.positions[index].vatValue);

            this.sumNetValue += netValue;
            this.sumVatValue += this.positions[index].vatValue;
            this.sumGrossValue += this.positions[index].grossValue;




        },

    };
}

function settlementData(grossValue, toSettled, grossSettled) {
    return {
        toSettlement: toSettled,
        grossValue: grossValue,
        grossSettlement: grossSettled ?? 0,
        calculate() {
            this.toSettlement = (this.grossValue - this.grossSettlement - grossSettled).toFixed(2);
        }
    }
}

Alpine.data('businessDocumentData', businessDocumentData);
Alpine.data('settlementData', settlementData);
Alpine.start()
