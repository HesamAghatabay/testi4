<template>
  <q-page padding>
    <!-- content -->
    <h3>Send Verify Page</h3>
    <q-input class="q-mx-lg" v-model="mobile" label="Mobile" outlined rounded />
    <q-btn @click="sendverify" class="q-ma-md" color="blue-8">Send Verify Code</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const mobile = ref('')
const router = useRouter()

function sendverify() {
  api
    .post('api/sendverify', {
      mobile: mobile.value,
    })
    .then((r) => {
      console.log(r.data)
      router.push('/confirm-login/' + mobile.value)
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'Login error ' + e,
      })
    })
}
</script>
