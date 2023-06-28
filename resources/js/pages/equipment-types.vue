<script setup>
import CreateEquipmentTypeForm from "@/views/pages/equipment-types/CreateEquipmentTypeForm.vue";
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";
import axios from "@axios";
const showDialog = ref(false);
const loading = ref(false);
const equipmentTypes = ref([]);

const loadFromServer = async () => {
  loading.value = true;
  try {
    await axios.get("equipment-types").then((response) => {
      equipmentTypes.value = response.data;
    });
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const typeAdded = () => {
  showDialog.value = false;
  loadFromServer();
};

loadFromServer();
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
        <VDialog v-model="showDialog" width="auto">
          <template v-slot:activator="{ props }">
            <VBtn color="primary mx-5" v-bind="props"> Create </VBtn>
          </template>
          <CreateEquipmentTypeForm
            @type-added="typeAdded"
            @close-dialog="showDialog = false"
          />
        </VDialog>
        <EquipmentTypesTable
          :equipmentTypes="equipmentTypes"
          :loading="loading"
        />
      </VCard>
    </VCol>
  </VRow>
</template>
