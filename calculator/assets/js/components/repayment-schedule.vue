<template>
    <div class="container">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Дата платежа</th>
                    <th scope="col">Основной долг</th>
                    <th scope="col">Проценты</th>
                    <th scope="col">Остаток долга</th>
                    <th scope="col">Общая сумма</th>
                    <th scope="col">Вид платежа</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="repayment in repayment_schedule">
                    <th scope="row">{{ repayment.repayment_index }}</th>
                    <td>{{ repayment.repayment_date }}</td>
                    <td>{{ repayment.main_debt }}</td>
                    <td>{{ repayment.percent }}</td>
                    <td>{{ repayment.remaining_debt }}</td>
                    <td>{{ repayment.general_sum }}</td>
                    <td>{{ repayment.type }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "repayment-schedule",
        props: [
            'repayment_schedule'
        ]
    }
</script>

<style scoped>

</style>