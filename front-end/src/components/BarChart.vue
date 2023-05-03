<template>
  <div>
    Ativo
    <select v-model="selected" @change="onChange($event)">
      <option v-for="option in options_select" :key="option.value" :value="option.value">
        {{ option.text }}
      </option>
    </select>

    <div>Selected: {{ selected }}</div>


    <Bar :data="data" :options="options" />
    <pagination-chart v-if="lendings.length" :offset="offset" :total="total" :limit="limit" @change-page="changePage" />
  </div>
</template>


<script lang="ts">
import PaginationChart from '@/components/PaginationChart.vue';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,

} from 'chart.js'
import { Bar } from 'vue-chartjs'
import axios from "axios";

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)


export default {
  name: 'App',
  components: {
    Bar,
    PaginationChart
  },


  data() {

    return {
      selected: '',
      options_select: [{ text: 'Todos', value: '', id: '' }],
      lendings: [1],
      offset: 0,
      total: 0,
      limit: 16,
      ativo: null,
      data: {
        labels: 'labels',
        datasets: [{}],


      },
      options: {
        scales: {
          x: {
            grid: {
              offset: false
            }
          }
        }
      }

    }
  },
  methods: {




    onChange(event) {
      console.log(event);
      if (this.selected == '') {
        this.limit = 16;
      } else {
        this.limit = 1;
        this.lendings.length=1;

      }

      this.getLending();

    },

    MountChart(res) {
      this.chart = res.data;
      console.log(this.chart[0]['columns']);
      let labels2 = [];
      for (let i = 0; i < this.limit; i++) {
        labels2.push(this.chart[i]['columns']);
      }
      let values2 = [];
      for (let i = 0; i < this.limit; i++) {
        values2.push(this.chart[i]['value']);

        this.options_select.push(
          { text: this.chart[i]['columns'], value: this.chart[i]['columns'], id: this.chart[i]['columns'] });
      }
      this.data = {
        labels: labels2,
        datasets: [{
          label: 'Preço Médio',
          data: values2,
          backgroundColor: ['#42b983'],
          borderColor: ['#42b983'],
          borderWidth: 1
        }]

      };

      this.options = {
        indexAxis: 'y',
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        }
      }


    },

    changePage(value) {
      this.offset = value;
      this.getLending();
    },
    getLending() {
      const BASE_URL = 'http://localhost:8000/api';
      const url = `${BASE_URL}/leding/chart?page=${this.offset}&size=${this.limit}&ativo=${this.selected}`;

      axios.get(url).then((data) => {
        this.ledings = data.data;
        this.total = data.data.totalledings;
        this.MountChart(data);
      });
    },



  },
  created() {
    this.getLending();
  },
  mounted() {
    //this.getLending();
  },
}
</script>