import './bootstrap';
import Alpine from "alpinejs";

// const productSelect = document.getElementById("product-select");
//
// function getDataFromApi(event) {
//     axios.get(`/products/${event.target.value}/json`)
//         .then((res) => {
//             document.getElementById("net-price-input").value = res.data.price;
//             document.getElementById("vat-rate-select").value = res.data.vat_rate_id;
//         })
// }
//
// productSelect.onchange = getDataFromApi;


function documentData() {
    return {
        //component state
        price: '',
        vatRate: '',
        unit: '',
        quantity: 0,
        vatValue: 0,
        grossValue: 0,

        getDataFromApi(event) {
            axios.get(`/products/${event.target.value}/json`)
                .then((res) => {
                    this.price = res.data.price;
                    this.vatRate = res.data.vat_rate_id;
                    this.unit = res.data.unit;

                })
        },

        calculateTaxes() {
            if (this.price === '' || this.vatRate === '' || this.quantity === 0) {
                return;
            }

            const vatRateValue = JSON.parse(VAT_RATES).filter(vatRate => vatRate.id === parseInt(this.vatRate))[0].rate;
            const netValue= this.price * this.quantity;
            this.vatValue = (netValue * vatRateValue) / 100;
            this.grossValue = netValue + this.vatValue;
        }
    }
}


Alpine.data('documentData', documentData);

Alpine.start()
