import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CreatePost from '../views/CreatePost.vue'
import EditPost from '../views/EditPost.vue'
import DetailPost from '../views/DetailPost.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/create',
      name: 'createPost',
      component: CreatePost
    },
    {
      path: '/:slug/detail',
      name: 'detailPost',
      component: DetailPost
    },
    {
      path: '/:slug/edit',
      name: 'editPost',
      component: EditPost
    },
  ]
})

export default router
