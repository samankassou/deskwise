<script setup>
import DeleteEquipmentTypeDialog from "@/views/pages/equipment-types/DeleteEquipmentTypeDialog.vue";
import EquipmentTypeForm from "@/views/pages/equipment-types/EquipmentTypeForm.vue";
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";
import axios from "@axios";
const showDialog = ref(false);
const dialogMode = ref("create");
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
const typeUpdated = () => {
  showDialog.value = false;
  loadFromServer();
};
const deleteType = (id) => {
  currentId.value = id;
  showDeleteDialog.value = true;
};
const editType = (id) => {
  currentId.value = id;
  dialogMode.value = "edit";
  showDialog.value = true;
};
const createType = () => {
  currentId.value = null;
  dialogMode.value = "create";
  showDialog.value = true;
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
        <VBtn color="primary mx-5" @click="createType"> Create </VBtn>
        <VDialog v-model="showDialog" width="auto">
          <EquipmentTypeForm
            :currentId="currentId"
            :dialogMode="dialogMode"
            @type-added="typeAdded"
            @type-updated="typeUpdated"
            @close-dialog="showDialog = false"
          />
        </VDialog>
        <EquipmentTypesTable
          :equipmentTypes="equipmentTypes"
          :loading="loading"
          @delete-equipment-type="deleteType"
          @edit-equipment-type="editType"
        />
      </VCard>
    </VCol>
  </VRow>
</template>
