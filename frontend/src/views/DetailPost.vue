<template>
  <div class="m-8">
    <div class="text-xl font-semibold mb-8">Detail Post</div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Title</div>
      <div class="font-semibold">: {{ data.title }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Category</div>
      <div class="font-semibold">: {{ data.category }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Status</div>
      <div class="font-semibold">: {{ data.status }}</div>
    </div>
    <div class="grid grid-cols-2 text-lg gap-4 mb-4">
      <div>Description</div>
      <div class="font-semibold">: {{ data.description }}</div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, reactive } from "vue";
import { useRoute } from "vue-router";
const {params} = useRoute()

const data = reactive({
  title: '',
  category: '',
  status: '',
  description: ''
})


onMounted(() => {
  axios.get(`http://localhost:8000/api/posts/${params.slug}`)
  .then((res) => {
    data.title = res.data.title
    data.category = res.data.category
    data.status = res.data.status
    data.description = res.data.description
  })
  .catch(err => console.log(err))
})

</script>
