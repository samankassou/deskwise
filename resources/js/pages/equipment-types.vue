<script setup>
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";
import axios from "@axios";
import { ref } from "vue";

const equipmentTypes = ref([]);

const GetEquipmentTypes = async () => {
  await axios.get("equipment-types").then((response) => {
    equipmentTypes.value = response.data.data;
  });
};
GetEquipmentTypes();
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
        <EquipmentTypesTable />
      </VCard>
    </VCol>
  </VRow>
</template>
