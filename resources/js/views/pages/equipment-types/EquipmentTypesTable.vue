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
      <tr v-for="type in equipmentTypes" :key="type.id">
        <td>
          {{ type.id }}
        </td>
        <td class="text-center">
          {{ type.name }}
        </td>
        <td class="text-center">
          {{ type.slug }}
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
