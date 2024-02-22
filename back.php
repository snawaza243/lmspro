<link rel="stylesheet" type="text/css" href="styles/back.css">
<style>
.back-button {
    position: fixed;
    /* Ensures fixed positioning at the bottom-left */
    bottom: 20px;
    /* Adjust spacing from bottom */
    left: 20px;
    /* Adjust spacing from left */
    z-index: 999;
    /* Ensures button stays on top of content */
    background-color: #333;
    /* Customize background color */
    color: #fff;
    /* Customize text color */
    padding: 10px 15px;
    /* Adjust padding */
    border: none;
    /* Remove default border */
    border-radius: 5px;
    /* Add rounded corners */
    cursor: pointer;
    /* Indicate clickable behavior */
    font-size: 16px;
    /* Adjust font size */
    text-decoration: none;
    /* Remove underline */
    display: flex;
    /* Allow alignment of icon and text */
    align-items: center;
    /* Center vertically */
    justify-content: center;
    /* Center horizontally */
    transition: background-color 0.2s ease-in-out;
    /* Add subtle hover effect */
}

.back-button:hover {
    background-color: #222;
    /* Customize hover background color */
}

.fas.fa-arrow-left {
    margin-right: 5px;
    /* Adjust spacing between icon and text */
}
</style>
<button id="backBtn" class="back-button">
    <i class="fas fa-arrow-left"></i> Back
</button>
<script>
function goBack() {
    window.history.back(); /* Navigates to the previous page in browser history */
}

document.getElementById("backBtn").addEventListener("click", goBack);
</script>