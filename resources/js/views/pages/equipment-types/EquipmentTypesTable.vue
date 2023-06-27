<script setup>
import axios from "@axios";
const headers = ref([
  { text: "ID", value: "id" },
  { text: "NAME", value: "name", sortable: true },
  { text: "SLUG", value: "slug" },
]);
const items = ref([]);
const loading = ref(false);
const serverItemsLength = ref(0);
const serverOptions = ref({
  page: 1,
  rowsPerPage: 2,
  sortBy: "name",
  sortType: "desc",
});

const loadFromServer = async () => {
  loading.value = true;
  try {
    await axios.get("equipment-types", serverOptions).then((response) => {
      let responseData = response.data;
      items.value = responseData.data;
      serverItemsLength.value = responseData.total;
    });
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

// initial load
loadFromServer();

watch(
  serverOptions,
  () => {
    loadFromServer();
  },
  { deep: true }
);
</script>

<template>
  <VRow class="px-5 py-5">
    <VCol cols="12">
      <EasyDataTable
        v-model:server-options="serverOptions"
        :server-items-length="serverItemsLength"
        :loading="loading"
        :headers="headers"
        :items="items"
        :sort-by="serverOptions.sortBy"
        :sort-type="serverOptions.sortType"
        buttons-pagination
      />
    </VCol>
  </VRow>
</template>
