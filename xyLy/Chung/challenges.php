<?php require('./function/function.php');
checkauth();
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Challenges</title>
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
  <!-- Tailwind CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css">
  <!-- Custom CSS -->
  <style>
    body{
        background-color: #fff;
    }
    .bg-purple {
      background-color: #6b46c1;
    }
    .text-white {
      color: white;
    }
    .text-gray {
      color: #a0aec0;
    }
    .text-sm {
      font-size: 0.875rem;
    }
    .text-lg {
      font-size: 1.125rem;
    }
    .text-xl {
      font-size: 1.25rem;
    }
    .font-bold {
      font-weight: bold;
    }
    .font-light {
      font-weight: 300;
    }
    .rounded {
      border-radius: 0.25rem;
    }
    .shadow {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
    .p-2 {
      padding: 0.5rem;
    }
    .p-4 {
      padding: 1rem;
    }
    .m-2 {
      margin: 0.5rem;
    }
    .m-4 {
      margin: 1rem;
    }
    .mt-4 {
      margin-top: 1rem;
    }
    .ml-4 {
      margin-left: 1rem;
    }
    .mr-4 {
      margin-right: 1rem;
    }
    .mb-4 {
      margin-bottom: 1rem;
    }
    .flex {
      display: flex;
    }
    .flex-col {
      flex-direction: column;
    }
    .flex-row {
      flex-direction: row;
    }
    .items-center {
      align-items: center;
    }
    .justify-between {
      justify-content: space-between;
    }
    .justify-center {
      justify-content: center;
    }
    .w-full {
      width: 100%;
    }
    .w-1/2 {
      width: 50%;
    }
    .w-1/3 {
      width: 33.333333%;
    }
    .w-2/3 {
      width: 66.666667%;
    }
    .h-full {
      height: 100%;
    }
    .h-1/2 {
      height: 50%;
    }
    .h-1/3 {
      height: 33.333333%;
    }
    .h-2/3 {
      height: 66.666667%;
    }
    .max-w-screen-md {
      max-width: 768px;
    }
    .max-h-screen {
      max-height: 100vh;
    }
    .overflow-y-auto {
      overflow-y: auto;
    }
    .btn {
      display: inline-block;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.25rem;
      font-weight: bold;
      cursor: pointer;
    }
    .btn-purple {
      background-color: #9f7aea;
      color: white;
    }
    .btn-purple:hover {
      background-color: #b794f4;
    }
    .close {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      width: 1.5rem;
      height: 1.5rem;
      font-size: 1.5rem;
      font-weight: bold;
      color: white;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
            <?= getAllChallenge();?>
  <!-- Bootstrap CDN -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
