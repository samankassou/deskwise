<script setup>
import axios from "@axios";
import "ag-grid-community/styles/ag-grid.css"; // Core grid CSS, always needed
import "ag-grid-community/styles/ag-theme-alpine.css"; // Optional theme CSS
import { AgGridVue } from "ag-grid-vue3"; // the AG Grid Vue Component
import { onMounted, reactive, ref } from "vue";

// Use it!
//toast("I'm a toast!");
// definitions
const gridApi = ref(null); // for accessing Grid's API
const gridColumnApi = ref(null); // for accessing Grid's API
const rowBuffer = ref(null);
const rowSelection = ref(null);
const rowModelType = ref(null);
const cacheBlockSize = ref(null);
const cacheOverflowSize = ref(null);
const maxConcurrentDatasourceRequests = ref(null);
const infiniteInitialRowCount = ref(null);
const maxBlocksInCache = ref(null);
const equipmentTypesData = reactive({});
rowBuffer.value = 0;
rowSelection.value = "multiple";
rowModelType.value = "infinite";
cacheBlockSize.value = 20;
cacheOverflowSize.value = 2;
maxConcurrentDatasourceRequests.value = 1;
maxBlocksInCache.value = 10;
// Each Column Definition results in one Column.
const columnDefs = reactive({
  value: [
    {
      headerName: "ID",
      maxWidth: 100,
      field: "id",
      cellRenderer: (params) => {
        if (params.value !== undefined) {
          return params.value;
        } else {
          return '<img src="https://www.ag-grid.com/example-assets/loading.gif">';
        }
      },
    },
    {
      headerName: "Name",
      field: "name",
      sortable: true,
      filter: true,
    },
    { field: "slug" },
  ],
});
// DefaultColDef sets props common to all Columns
const defaultColDef = {
  sortable: true,
  filter: true,
  flex: 1,
};
// building datasource
const dataSource = {
  rowCount: undefined,
  getRows: (params) => {
    console.log("asking for " + params.startRow + " to " + params.endRow);
    console.log(params);
    // At this point in your code, you would call the server.
    axios.get("equipment-types").then((response) => {
      //equipmentTypesData.value = response.data.data.data;
      console.log(response.data.data);
      params.successCallback(response.data.data.data, response.data.data.to);
    });
  },
};

// Obtain API from grid's onGridReady event
const onGridReady = (params) => {
  gridApi.value = params.api;
  gridColumnApi.value = params.columnApi;
  params.api.setDatasource(dataSource);
};
const cellWasClicked = (event) => {
  // consuming Grid Event
  console.log("cell was clicked", event);
};
const fetchEquipmentTypesData = async () => {
  try {
    await axios.get("equipment-types").then((response) => {
      equipmentTypesData.value = response.data.data.data;
    });
  } catch (error) {
    console.error(error);
  }
};
// load data from server
onMounted(() => {
  fetchEquipmentTypesData();
});
</script>

<template>
  <AgGridVue
    class="ag-theme-alpine px-5 py-5"
    style="height: 400px"
    :columnDefs="columnDefs.value"
    :defaultColDef="defaultColDef"
    :rowBuffer="rowBuffer"
    :rowSelection="rowSelection"
    :rowModelType="rowModelType"
    :cacheBlockSize="cacheBlockSize"
    :cacheOverflowSize="cacheOverflowSize"
    :maxConcurrentDatasourceRequests="maxConcurrentDatasourceRequests"
    :infiniteInitialRowCount="infiniteInitialRowCount"
    :maxBlocksInCache="maxBlocksInCache"
    animateRows="true"
    @cell-clicked="cellWasClicked"
    @grid-ready="onGridReady"
  >
  </AgGridVue>
</template>
