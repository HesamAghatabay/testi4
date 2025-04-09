import { defineStore, acceptHMRUpdate } from 'pinia'

export const usePostData = defineStore('PostData', {
  state: () => ({
    post: [],
    currentPostIndex: [],
    user: [],
  }),
  getters: {},
  actions: {},
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(usePostData, import.meta.hot))
}
