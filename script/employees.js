
function employeeListDetect(page) {
        loadContent(['includes/employees.php','page', page],'employees');
        return false; //to prevent the default anchor behavior.
    }
//             // document.getElementById("employee_offset_go").addEventListener("click",function() {
//             // offset = document.getElementById('employee_offset').value;
//             console.log(offset);
//             loadContent(["includes/employees.php","offset",offset],employees);
// });

