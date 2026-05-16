import EmployeeForm from "../components/EmployeeForm";
import { useEffect } from "react";
import { fetchEmployeeById } from "../services/employeeService";

function UpdateEmployee({id}: {id: number}) {
    const fetchData = async () => {
        await fetchEmployeeById(id);
      };
    
      useEffect(() => {
          fetchData();
      }, []); //fetch data on component mount
    return <EmployeeForm loadEmployees={fetchData} />;
    }

    export default UpdateEmployee;