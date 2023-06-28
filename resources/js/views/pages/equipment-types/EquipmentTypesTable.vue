<script setup>
defineEmits(["deleteEquipmentType"]);
defineProps({
  equipmentTypes: Array,
  loading: Boolean,
});
const headers = ref([
  { text: "NAME", value: "name", sortable: true },
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
        :items="equipmentTypes"
        alternating
        show-index
        buttons-pagination
      >
        <template #item-actions="{ id }">
          <VBtn
            icon="mdi-delete-outline"
            @click="$emit('deleteEquipmentType', id)"
            variant="text"
          />
        </template>
      </EasyDataTable>
    </VCol>
  </VRow>
</template>
