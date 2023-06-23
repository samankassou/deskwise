<script setup>
import { ref } from "vue";
import axios from "@axios";
import EquipmentsTypesTable from "@/views/pages/equipment-types/EquipmentsTypesTable.vue";

const equipmentTypes = ref([]);

const GetTypes = async () => {
  await axios.get("equipment-types").then((response) => {
    equipmentTypes.value = response.data.data;
  });
};
GetTypes();
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
        <EquipmentsTypesTable :equipment-types="types" />
      </VCard>
    </VCol>
  </VRow>
</template>
