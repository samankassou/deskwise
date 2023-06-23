<script setup>
import { ref } from "vue";
import axios from "@axios";
<<<<<<< HEAD
import EquipmentTypesTable from "@/views/pages/equipment-types/EquipmentTypesTable.vue";

const equipmentTypes = ref([]);

const GetEquipmentTypes = async () => {
=======
import EquipmentsTypesTable from "@/views/pages/equipment-types/EquipmentsTypesTable.vue";

const equipmentTypes = ref([]);

const GetTypes = async () => {
>>>>>>> 2f5ee13733f41555965ae7318aaaca9bce58d84e
  await axios.get("equipment-types").then((response) => {
    equipmentTypes.value = response.data.data;
  });
};
<<<<<<< HEAD
GetEquipmentTypes();
=======
GetTypes();
>>>>>>> 2f5ee13733f41555965ae7318aaaca9bce58d84e
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard title="Equipments types">
<<<<<<< HEAD
        <EquipmentTypesTable :equipment-types="equipmentTypes" />
=======
        <EquipmentsTypesTable :equipment-types="types" />
>>>>>>> 2f5ee13733f41555965ae7318aaaca9bce58d84e
      </VCard>
    </VCol>
  </VRow>
</template>
