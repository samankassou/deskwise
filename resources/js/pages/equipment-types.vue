<script setup>
import CreateEquipmentTypeForm from "@/views/pages/equipment-types/CreateEquipmentTypeForm.vue";
import DeleteEquipmentTypeDialog from "@/views/pages/equipment-types/DeleteEquipmentTypeDialog.vue";
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";
import axios from "@axios";
const showDialog = ref(false);
const showDeleteDialog = ref(false);
const loading = ref(false);
const currentId = ref(null);
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
const deleteType = (id) => {
  currentId.value = id;
  showDeleteDialog.value = true;
};
const typeDeleted = () => {
  showDeleteDialog.value = false;
  loadFromServer();
};

loadFromServer();
</script>

<template>
  <VRow>
    <VDialog v-model="showDeleteDialog" width="auto">
      <DeleteEquipmentTypeDialog
        :currentId="currentId"
        @type-deleted="typeDeleted"
        @close-delete-dialog="showDeleteDialog = false"
      />
    </VDialog>

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
          @delete-equipment-type="deleteType"
        />
      </VCard>
    </VCol>
  </VRow>
</template>
