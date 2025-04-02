import { defineStore, acceptHMRUpdate } from 'pinia'

export const usecategoryData = defineStore('categoryData', {
  state: () => ({
    category: [],
    currentCategoryIndex: [],
    user: [],
  }),
  getters: {},
  actions: {},
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(usecategoryData, import.meta.hot))
}
