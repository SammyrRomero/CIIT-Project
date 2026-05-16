import Employeeform from "../components/EmployeeForm";
import { useEffect } from "react";
import { fetchAllEmployees } from "../services/employeeService";

function CreateEmployee() {
    const fetchData = async () => {
        await fetchAllEmployees();
      };
    
      useEffect(() => {
          fetchData();
      }, []); //fetch data on component mount

    return <Employeeform loadEmployees={fetchData} />
    }

    export default CreateEmployee;