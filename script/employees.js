// what the fuck is going on here even
function employeeListDetect(){
                const employees = "employees"
                document.getElementById("employee_offset_go").addEventListener("click",function() {
                offset = document.getElementById('employee_offset').value;
                loadContent(["includes/employees.php","?offset=",offset],employees);
                });
            }
