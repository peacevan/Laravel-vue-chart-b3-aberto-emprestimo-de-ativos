import Vue from 'vue'
import VueRouter from 'vue-router'
import BarView from '../views/BarView.vue'
Vue.use(VueRouter)
  const routes = [
  {
    path: '/',
    name: 'Bar chart',
    component: BarView
  },
  
  
]
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
export default router