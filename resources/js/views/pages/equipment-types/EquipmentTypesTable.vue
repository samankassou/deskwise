<script setup>
const props = defineProps(["equipmentTypes"]);
</script>

<template>
  <VTable>
    <thead>
      <tr>
        <th class="text-uppercase">#</th>
        <th>Name</th>
        <th>slug</th>
      </tr>
    </thead>

    <tbody>
<<<<<<< HEAD:resources/js/views/pages/equipment-types/EquipmentTypesTable.vue
      <tr v-for="equipmentType in equipmentTypes" :key="type.id">
=======
      <tr v-for="type in equipmentTypes" :key="type.id">
>>>>>>> 2f5ee13733f41555965ae7318aaaca9bce58d84e:resources/js/views/pages/equipments-types/EquipmentsTypesTable.vue
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
