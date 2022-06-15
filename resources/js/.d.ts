declare module 'vue-sorted-table';
declare module 'vuejs-smart-table';

type SortKey = (row: any, sortOrder: SortOrder) => any

declare enum SortOrder {
  DESC = -1,
  NONE = 0,
  ASC= 1
}
declare interface TableState {
  rows: any[],
  rowsPrePagination: any[],
  selectedRows: any[]
}