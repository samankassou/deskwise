<script setup>
defineEmits(["deleteDepartment", "editDepartment"]);
defineProps({
  departments: Array,
  loading: Boolean,
});
const headers = ref([
  { text: "NAME", value: "name", sortable: true },
  { text: "DIRECTION", value: "direction.name", sortable: true },
  { text: "SLUG", value: "slug" },
  { text: "ACTIONS", value: "actions" },
]);
</script>

<template>
  <VRow class="px-5 py-5">
    <VCol cols="12">
      <EasyDataTable
        :loading="loading"
        :headers="headers"
        :items="departments"
        alternating
        show-index
        buttons-pagination
      >
        <template #item-actions="{ id }">
          <VBtn
            icon="mdi-pencil-outline"
            @click="$emit('editDepartment', id)"
            variant="text"
          />
          <VBtn
            icon="mdi-delete-outline"
            @click="$emit('deleteDepartment', id)"
            variant="text"
          />
        </template>
      </EasyDataTable>
    </VCol>
  </VRow>
</template>
