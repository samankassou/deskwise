<script setup>
import { ref } from "vue";
import axios from "@axios";
import EquipmentsTypesTable from "@/views/pages/equipments-types/EquipmentsTypesTable.vue";

const types = ref([]);

const GetTypes = async () => {
  await axios.get("types").then((response) => {
    types.value = response.data.data;
  });
};
GetTypes();
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
        <EquipmentsTypesTable :equipments-types="types" />
      </VCard>
    </VCol>
  </VRow>
</template>
