<template>
  
  <div id="app">
    
    
    <!--

    <div id="nav">
      <router-link to="/">Line</router-link> |
      <router-link to="/bar">Bar</router-link> |
      <router-link to="/doughnut">Doughnut</router-link> |
      <router-link to="/pie">Pie</router-link> |
      <router-link to="/radar">Radar</router-link> |
      <router-link to="/polar-area">Polar Area</router-link> |
      <router-link to="/bubble">Bubble</router-link> |
      <router-link to="/scatter">Scatter</router-link>
    </div>-->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <BarChart/>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss">
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }
  #nav {
    padding: 30px 30px 60px;
    a {
      font-weight: bold;
      color: #2c3e50;
      &.router-link-exact-active {
        color: #42b983;
      }
    }
  }
</style>



<script>
//import HelloWorld from './components/HelloWorld.vue'
//import BarChart from './components/BarChart.vue';
//import  router  from 'vue-router'
//import    router  from './router/index'
import  BarChart from './views/BarView.vue'

export default {
  name: 'App',
  components: {
    BarChart,
   } 
}
</script>
