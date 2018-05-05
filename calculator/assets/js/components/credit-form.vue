<template>
    <div class="container w-100">
        <form ref="form_ref" v-bind:action="apiUrl" method="post" @submit="submitForm">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="sum">Сумма кредита</label>
                    <input type="text" class="form-control .is-invalid" id="sum" name="sum" placeholder="100000" value="100000" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="months">Срок кредита, мес</label>
                    <input type="text" class="form-control" id="months" name="months" placeholder="12" value="12" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rate">Процентная ставка, %</label>
                    <input type="text" class="form-control" id="rate" name="rate" placeholder="10" value="10" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 mb-3 w-50">
                    <label for="first_payment_date">Дата первого платежа</label>
                    <datepicker :value="datePicker.placeholder" id="first_payment_date" name="first_payment_date" required input-class="form-control" format="dd.MM.yyyy" :placeholder="datePicker.placeholder"></datepicker>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary btn-lg btn-block" id="submit-btn" type="submit">Отправить</button>
            </div>
        </form>
        <div v-for="error in errors" class="alert alert-danger">{{ error }}</div>
        <repayment-schedule :repayment_schedule="repayment_schedule"></repayment-schedule>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import Axios from 'axios';
    import RepaymentSchedule from './repayment-schedule';

    Axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';

    let dateFormat = require('dateformat');

    export default {
        components: {RepaymentSchedule, Datepicker},
        props: ['api-url'],
        name: "credit-form",
        data: function() {
            return {
                datePicker: {
                    placeholder: dateFormat(new Date(), 'dd.mm.yyyy')
                },
                repayment_schedule: [],
                errors: []
            }
        },
        methods: {
            submitForm: function(e) {
                e.preventDefault();
                let self = this;
                let $self = $(self.$el);
                let $submit = $self.find('#submit-btn');

                $submit.attr('disabled', 'disabled');

                self.errors = [];

                Axios({
                    method: 'post',
                    url: self.apiUrl,
                    data: new FormData(self.$refs.form_ref)
                })
                    .then(function (response) {
                        $submit.removeAttr('disabled');
                        self.repayment_schedule = response.data.data;
                    })
                    .catch(function (error) {
                        $submit.removeAttr('disabled');
                        self.errors.push(error.response.data.error || error.message);
                    });

                return false;
            }
        }
    }
</script>

<style scoped>
</style>