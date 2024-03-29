import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StudentsView from '../views/students/StudentsView.vue'
import StudentsCreate from '../views/students/StudentsCreate.vue'
import StudentsEdit from '../views/students/StudentsEdit.vue'
import StudentsAuth from '../views/students/StudentsAuth.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/students',
      name: 'students',
      component: StudentsView
    },
    {
      path: '/students/create',
      name: 'st udentsCreate',
      component: StudentsCreate
    },
    {
      path: '/students/:id/edit',
      name: 'StudentsEdit',
      component: StudentsEdit
    },
    {
      path: '/students/auth',
      name: 'StudentsAuth',
      component: StudentsAuth
    },
  ]
})

export default router
