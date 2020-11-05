<template>
<div>
    <h2>Forcast Data</h2>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Actual</th>
            <th>Forecast</th>
            <th>Index</th>

        </tr>
        </thead>
        <tbody>
        <tr v-for="data in foracstData" :key="data.id">
            <td>{{ data.from |formatDate}}</td>
            <td>{{ data.to|formatDate }}</td>
            <td>{{ data.intensity.actual }}</td>
            <td>{{ data.intensity.forecast }}</td>
            <td>{{ data.intensity.index }}</td>
        </tr>

        </tbody>
    </table>
</div>
</template>

<script>
import moment from 'moment'
export default {
    data(){
        return {
            foracstData:[],
        }
    }, filters: {
        formatDate:function(value) {
            if (value) {
                return moment(String(value)).format('MM/DD/YYYY hh:mm')
            }
        }
    },methods: {
        getData() {
            var that = this;
            axios.get('/api/getData')
                .then(response => {
                    that.foracstData = response.data;
                });
        },



    },
mounted() {
    this.getData();
}


}

</script>
