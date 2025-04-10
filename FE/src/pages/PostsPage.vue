<template>
  <q-page padding>
    <!-- content -->
    <h4>PostsPage</h4>
    <div class="col-3 q-gutter-lg" v-for="(post, index) in posts" :key="'post' + index">
      <q-card>
        <q-card-section>
          <h4>{{ post?.name || 'بدون نام' }}</h4>
        </q-card-section>
        <q-card-section>
          <p>{{ post?.body || 'بدون بادی' }}</p>
        </q-card-section>
        <q-card-action>
          <q-btn
            color="amber-9"
            @click="
              postdata.currentPostIndex = index
              $router.push('edit-post/' + post.id)
            "
          >
            Edit
          </q-btn>
          <q-btn color="red-9" @click="deletepost(post.id)">Delete</q-btn>
          <q-btn color="info" @click="$router.push('show-post/' + post.id)">Show</q-btn>
        </q-card-action>
      </q-card>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, reactive } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const post = reactive({
  name: null,
  category: null,
  body: null,
})

onMounted(() => {
  api
    .get('api/post/' + route.params.id)
    .then((r) => {
      post.name = r.data.name
      post.category = r.data.category
      post.body = r.data.body
    })
    .catch((e) => {
      console.log(e)
    })
})
</script>
