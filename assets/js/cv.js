document.getElementById("downloadBtn").addEventListener("click", function () {
  // Create a temporary link

  const link = document.createElement("a");

  link.href = "assets/CV/CV_LY_Chhaythean (1).pdf"; // Path to your CV file

  link.download = "LY-Chhaythean CV.pdf"; // Name for the downloaded file

  link.click(); // Trigger the download
});