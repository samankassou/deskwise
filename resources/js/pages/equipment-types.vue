<script setup>
import CreateEquipmentTypeForm from "@/views/pages/equipment-types/CreateEquipmentTypeForm.vue";
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";
const dialog = ref(false);
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
        <VDialog v-model="dialog" width="auto">
          <template v-slot:activator="{ props }">
            <VBtn color="primary mx-5" v-bind="props"> Create </VBtn>
          </template>
          <CreateEquipmentTypeForm />
        </VDialog>
        <EquipmentTypesTable />
      </VCard>
    </VCol>
  </VRow>
</template>
