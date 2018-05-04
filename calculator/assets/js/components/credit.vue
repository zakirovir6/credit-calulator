<template>
    <form v-bind:action="apiUrl" method="post" @submit="submitForm">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="credit-sum">Сумма кредита</label>
                <input type="text" class="form-control .is-invalid" id="credit-sum" name="rate" placeholder="100000" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="credit-sum">Срок кредита, мес</label>
                <input type="text" class="form-control" id="period" name="period" placeholder="12" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="credit-sum">Процентная ставка, %</label>
                <input type="text" class="form-control" id="rate" name="rate" placeholder="10" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mb-3 w-50">
                <label for="credit-sum">Дата первого платежа</label>
                <datepicker id="payment-date" name="payment-date" required input-class="form-control" format="dd.MM.yyyy" v-bind:placeholder="datePicker.placeholder"></datepicker>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Отправить</button>
        </div>
    </form>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    let dateFormat = require('dateformat');
    export default {
        components: {Datepicker},
        props: ['api-url'],
        name: "credit-calculator",
        data: function() {
            return {
                datePicker: {
                    placeholder: dateFormat(new Date(), 'dd.mm.yyyy')
                }
            }
        },
        methods: {
            submitForm: function(e) {
                e.preventDefault();
console.log(dateFormat);
                return false;
            }
        }
    }
</script>

<style scoped>
</style>