// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    pageLength: 5,
    order: [[ 0, "desc" ]]
  });
});
