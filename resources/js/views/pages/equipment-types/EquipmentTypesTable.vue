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
      <tr v-for="equipmentType in equipmentTypes" :key="type.id">
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
