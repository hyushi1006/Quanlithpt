$(document).ready(function(){

    $('.table').DataTable({

        language:{

            search:"Tìm kiếm:",
            lengthMenu:"Hiển thị _MENU_ dòng",
            info:"Hiển thị _START_ đến _END_",
            paginate:{
                previous:"Trước",
                next:"Sau"
            }
        }

    });

});