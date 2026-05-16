import React, {useState} from "react";
import type {EmployeeFormData} from "../types/employee";
import { createEmployee } from "../services/employeeService";
import {useNavigate} from "react-router-dom";

function EmployeeForm({ loadEmployees }: { loadEmployees: () => void }) {
    const [loading, setLoading] = useState(false);
    const navigate = useNavigate(); 
    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        setLoading(true);

        const cleanedData: EmployeeFormData = {
            email: event.currentTarget.email.value.toString().trim(),
            last_name: event.currentTarget.last_name.value.toString().trim(),
            first_name: event.currentTarget.first_name.value.toString().trim(),
            gender: event.currentTarget.gender.value.toString(),
            department_id: Number(event.currentTarget.department_id.value),
            birthdate: event.currentTarget.birthdate.value.toString().trim(),
            date_hired: event.currentTarget.date_hired.value.toString().trim(),
            salary: Number(event.currentTarget.salary.value),
        };

        try {
            await createEmployee(cleanedData);
            loadEmployees(); // Refresh the employee list
        } catch (error) {
            console.error("Error creating employee:", error);
        } finally {
            setLoading(false); 
        }
    };

    const handleCancel = () => {
        navigate("/"); // Redirect to the employee list page
    };
    return (
        <>
            <h2>Add New Employee</h2>

            <form onSubmit={handleSubmit}> 
                <div>
                    <label htmlFor="first_name">First Name:</label>
                    <input id="first_name" name="first_name" required type="text" />
                </div>

                <div>
                    <label htmlFor="last_name">Last Name:</label>
                    <input id="last_name" name="last_name" required type="text" />
                </div>

                <div>
                    <label htmlFor="gender">Gender:</label>
                    <select id="gender" name="gender">
                    <option value="">Select a gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    </select>
                </div>

                <div>
                    <label htmlFor="birthdate">Birth Date:</label>
                    <input id="birthdate" name="birthdate" type="date" />
                </div>

                <div>
                    <label htmlFor="email">Email:</label>
                    <input id="email" name="email" required type="email" />
                </div>

                <div>
                    <label htmlFor="date_hired">Date Hired:</label>
                    <input id="date_hired" name="date_hired" required type="date" />
                </div>

                <div>
                    <label htmlFor="department_id">Department:</label>
                    <select id="department_id" name="department_id" required>
                    <option value="">Select a department</option>
                    <option value="1">HR</option>
                    <option value="2">IT</option>
                    <option value="3">Finance</option>
                    </select>
                </div>

                <div>
                    <label htmlFor="salary">Salary:</label>
                    <input id="salary" name="salary" required type="number" />
                </div>

                <div>
                    <button type="submit" disabled={loading}>
                    {loading ? "Saving..." : "Save"}
                    </button>
                    <button type="button" onClick={handleCancel}>
                        Cancel
                    </button>
                </div>

            </form>
        </>
    )
}

export default EmployeeForm;
