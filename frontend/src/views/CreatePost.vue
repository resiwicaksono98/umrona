<template>
  <div class="m-8">
    <div class="text-xl font-semibold mb-8">Create Post</div>
    <form @submit.prevent="submit">
      <div class="mb-4 ">
        <label for="title">Title</label>
        <input type="text" v-model="form.title" class="mt-2 border-slate-300 w-full rounded-lg" placeholder="Title posts">
        <div v-if="errors.title" class="text-red-500 my-2">
          {{ errors.title}}
        </div>
      </div>
      <div class="mb-4 ">
        <label for="status">Category</label>
        <input v-model="form.category" type="text" class="mt-2 border-slate-300 w-full rounded-lg" placeholder="Category posts">
        <div v-if="errors.category" class="text-red-500 my-2">
          {{ errors.category}}
        </div>
      </div>
      <div class="mb-4 ">
        <label for="status">Status</label>
        <select v-model="form.status" class="mt-2 border-slate-300 w-full rounded-lg">
          <option value="" disabled selected>Select Your Status</option>
          <option value="draft">Draft</option>
          <option value="published">published</option>
        </select>
        <div v-if="errors.status" class="text-red-500 my-2">
          {{ errors.status}}
        </div>
      </div>
      <div class="mb-4 ">
        <label for="status">Description</label>
        <textarea v-model="form.description" class="mt-2 border-slate-300 w-full rounded-lg" rows="8" placeholder="Description posts"></textarea>
        <div v-if="errors.description" class="text-red-500 my-2">
          {{ errors.description}}
        </div>
      </div>
      <button type="submit" class="bg-blue-500 py-2 px-4 rounded-lg text-white">Create Post</button>
    </form>
  </div>
</template>

<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

const form = reactive({
  title: '',
  category: '',
  status: '',
  description: ''
})

const errors = reactive({
  title: '',
  category: '',
  status: '',
  description: ''
})


function submit() {
  axios.post(`http://localhost:8000/api/posts`,form)
  .then(() => {
    alert('Success Create Post')
    router.push('/')
  }).catch((err) => {
    errors.title = err.response.data.error.title ? err.response.data.error.title[0] : ''
    errors.category = err.response.data.error.category ? err.response.data.error.category[0] : ''
    errors.status = err.response.data.error.status ? err.response.data.error.status[0] : ''
    errors.description = err.response.data.error.description ? err.response.data.error.description[0] : ''

  })
}

</script>
