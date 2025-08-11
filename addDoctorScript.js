function clearForm() {
    document.getElementById('doctorForm').reset();
    // Reset subcategory options
    document.getElementById('subcategory').innerHTML = '<option value="">Select Subcategory</option>';
}

function nextForm() {
    document.getElementById('doctorForm').reset();
    // Reset subcategory options
    document.getElementById('subcategory').innerHTML = '<option value="">Select Subcategory</option>';
}

function updateSubcategory() {
    const category = document.getElementById('category').value;
    const subcategorySelect = document.getElementById('subcategory');
    
    // Reset subcategory options
    subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
    
    // Check category and add subcategories accordingly
    if (category === 'Specialist') {
        subcategorySelect.innerHTML += `
            <option value="Gastro">Gastro</option>
            <option value="Cardiologist">Cardiologist</option>
            <option value="Pathologist">Pathologist</option>
            <option value="Neurologist">Neurologist</option>
        `;
    } else if (category === 'Surgeon') {
        subcategorySelect.innerHTML += `
            <option value="Cardio">Cardio</option>
            <option value="Orthopedic">Orthopedic</option>
            <option value="Cardiologist">Cardiologist</option>
        `;
    } else if (category === 'General Physician') {
        subcategorySelect.innerHTML += `
            <option value="Family Physician">Family Physician</option>
            <option value="Medicine">Medicine</option>
        `;
    }
}
