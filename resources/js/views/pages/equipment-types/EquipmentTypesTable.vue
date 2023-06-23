<script setup>
const props = defineProps(["equipmentTypes"]);
const headers = [
  {
    title: "#",
    align: "start",
    sortable: false,
    key: "id",
  },
  { title: "Name", align: "end", key: "name" },
  { title: "Slug", align: "end", key: "slug" },
];
const itemsPerPage = 5;
</script>

<template>
  <VDataTable
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="equipmentTypes"
    item-value="name"
    class="elevation-1"
  ></VDataTable>
  <VTable>
    <thead>
      <tr>
        <th class="text-uppercase">#</th>
        <th>Name</th>
        <th>slug</th>
      </tr>
    </thead>

    <tbody>
<<<<<<< Updated upstream
<<<<<<< HEAD:resources/js/views/pages/equipment-types/EquipmentTypesTable.vue
      <tr v-for="equipmentType in equipmentTypes" :key="type.id">
=======
      <tr v-for="type in equipmentTypes" :key="type.id">
>>>>>>> 2f5ee13733f41555965ae7318aaaca9bce58d84e:resources/js/views/pages/equipments-types/EquipmentsTypesTable.vue
=======
      <tr v-for="equipmentType in equipmentTypes" :key="equipmentType.id">
>>>>>>> Stashed changes
        <td>
          {{ equipmentType.id }}
        </td>
        <td class="text-center">
          {{ equipmentType.name }}
        </td>
        <td class="text-center">
          {{ equipmentType.slug }}
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
