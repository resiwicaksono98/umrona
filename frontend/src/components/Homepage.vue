<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div class="m-8">
    <div class="mb-8  font-semibold text-xl underline">Umrona Test</div>
    <RouterLink to="/create" class="bg-blue-500 py-2 px-3 rounded-lg text-white">Create Posts</RouterLink>
    <!-- Table -->
    <div class="flex flex-col mt-4">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full text-left text-sm font-light">
              <thead class="border-b font-medium dark:border-neutral-500">
                <tr class="text-center">
                  <th scope="col" class="px-6 py-4">#</th>
                  <th scope="col" class="px-6 py-4">
                    Title
                  </th>
                  <th scope="col" class="px-6 py-4">
                    Category
                  </th>
                  <th scope="col" class="px-6 py-4">
                    Status
                  </th>
                  <th scope="col" class="px-6 py-4">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>

                  <tr v-for="(post, i) in posts " class="border-b dark:border-neutral-500 text-center" :key="i">
                    <td class="px-6 py-4 font-medium">{{ i + 1 }}</td>
                    <td class="px-6 py-4">
                      {{ post.title }}
                    </td>
                    <td class="px-6 py-4">
                      {{ post.category }}
                    </td>
                    <td class="px-6 py-4">
                      {{ post.status }}
                    </td>

                    <td class="px-6 py-4 ">
                      <div class="flex gap-2 justify-center text-white">
                        <RouterLink :to="`/${post.slug}/edit`"  class="bg-green-500 py-2 px-4 rounded-lg">
                          Edit
                        </RouterLink>
                        <RouterLink  :to="`/${post.slug}/detail`" class="bg-blue-500 py-2 px-4 rounded-lg">
                          Detail
                        </RouterLink>
                        <button @click.prevent="destroy(post.slug)"  class="bg-red-500 py-2 px-4 rounded-lg">
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>

                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { RouterLink } from 'vue-router';
import axios from 'axios'
import { onMounted, ref } from 'vue';

const posts = ref()

function getPosts() {
    axios.get(`http://localhost:8000/api/posts`)
      .then((res) => {
        posts.value = res.data.data
      })
      .catch((err) => {
        console.log(err);
      })
  }


onMounted(() => {
  getPosts()
})

function destroy(slug){
  axios.delete(`http://localhost:8000/api/posts/${slug}`)
  .then(() => {
    alert('Success Deleted Post')
    getPosts()
  })
  .catch((err) => console.log(err))
}

</script>
