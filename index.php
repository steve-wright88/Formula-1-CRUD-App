<?php
require 'drivers.php';
$drivers = getDrivers();
shuffle($drivers);
$freeAgents = getInactiveDrivers();
shuffle($freeAgents);
$driverTeams = array_unique(array_column($drivers, 'driverTeam'));
$teamColour = array_unique(array_column($drivers, 'teamColor'));
$teamCars = array_unique(array_column($drivers, 'teamCar'));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="path/to/pikaday.css">
  <script src="path/to/pikaday.js"></script>

  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

  <!-- jQuery UI JS -->
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            mercedes: "#6CD3BF",
            alphatauri: "#041f3d",
            alfaromeo: "#B12039",
            mclaren: "#ff8000",
            ferrari: "#ED1C24",
            redbull: "#001C39",
            alpine: "#2673e2",
            haas: "#111111",
            astonmartin: "#006653",
            williams: "#00a3e0",
            formula1: '#FF1801',
            offwhite: "#e8f4f4",
            tahiti: {
              100: "#cffafe",
              200: "#a5f3fc",
              300: "#67e8f9",
              400: "#22d3ee",
              500: "#06b6d4",
              600: "#0891b2",
              700: "#0e7490",
              800: "#155e75",
              900: "#164e63"
            }
          }
        }
      },
      darkMode: "class",
    };
  </script>
  <title>F1 2022 Season</title>
</head>

<body>

  <div class="bg-alphatauri text-mercedes text-center w-full shadow-xl mb-20">
    <h1 class="text-4xl py-4" style="font-family: 'Racing Sans One', cursive;">Formula 1 Drivers</h1>
  </div>
  <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
    <h1 class="text-formula1 font-bold text-3xl uppercase" style="font-family: 'Racing Sans One', cursive;">Active Drivers</h1>
    <button id="show-modal" class="bg-alphatauri text-mercedes hover:shadow-4xl font-bold py-2 px-4 rounded transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-105 duration-300 ">
      Add New Driver
    </button>
  </div>

  <div class="max-w-screen-xl mx-auto px-2 py-4 ">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 ">
      <?php foreach ($drivers as $driver) : ?>
        <a class="relative group" href="#">
          <div class="absolute -inset-1 bg-<?= $driver['teamColor'] ?> rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
          <div class="shadow-lg relative rounded-t bg-<?= $driver['teamColor'] ?>">
            <!-- Photo and number -->
            <div class="rounded-t-2xl relative">
              <div class="absolute left-0 top-0 p-2">
                <img class="w-12 h-8 rounded object-cover object-center" src="<?= $driver['countryFlag'] ?>" alt="<?= $driver['nationality'] ?>">
              </div>
              <div class="absolute right-0 bottom-0 p-2">
                <h2 class="text-3xl text-white font-extrabold"><?= $driver['permanentNumber'] ?></h2>
              </div>
              <img class="h-52 w-52 mx-auto rounded-t-lg object-cover object-top" src="<?= $driver['profilePicture'] ?>" alt="" />
            </div>
            <!-- Bottom of the card -->
            <div class="py-5 rounded-t-3xl bg-white shadow-t-2">
              <h5 class="text-xl font-bold text-slate-500 text-center"><?= $driver['givenName'] . ' ' . $driver['familyName'] ?></h5>
              <p class="mb-2 text-xs text-slate-300 text-center"><?= $driver['driverTeam'] ?></p>
              <img class="w-full h-auto" src="<?= $driver['teamCar'] ?>" alt="">
              <div class="flex justify-center mt-4 space-x-2 text-slate-500">
                <button class="p-1 rounded-full hover:text-blue-500 h-10 w-10" title="View Driver">
                  <i class="far fa-eye"></i>
                </button>
                <button class="p-1 rounded-full hover:text-green-500 h-10 w-10" title="Edit Driver">
                  <i class="far fa-edit"></i>
                </button>
                <button class="p-1 rounded-full text-green-500 hover:text-red-500 h-10 w-10" title="Deactivate Driver">
                  <i class="fas fa-check-circle"></i>
                </button>
              </div>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
    <h1 class="text-alphatauri font-bold text-3xl uppercase" style="font-family: 'Racing Sans One', cursive;">Free Agents</h1>
  </div>
  <div class="max-w-screen-xl mx-auto px-2 py-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 ">
      <?php foreach ($freeAgents as $freeAgent) : ?>
        <a class="relative group" href="#">
          <div class="absolute -inset-1 bg-<?= $freeAgent['teamColor'] ?> rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
          <div class="shadow-lg relative rounded-t bg-<?= $freeAgent['teamColor'] ?>">
            <!-- Photo and number -->
            <div class="rounded-t-2xl relative">
              <div class="absolute left-0 top-0 p-2">
                <img class="w-12 h-8 rounded object-cover object-center" src="<?= $freeAgent['countryFlag'] ?>" alt="<?= $freeAgent['nationality'] ?>">
              </div>
              <div class="absolute right-0 bottom-0 p-2">
                <h2 class="text-3xl text-white font-extrabold"><?= $freeAgent['permanentNumber'] ?></h2>
              </div>
              <img class="h-52 w-52 mx-auto rounded-t-lg object-cover object-top" src="<?= $freeAgent['profilePicture'] ?>" alt="" />
            </div>
            <!-- Bottom of the card -->
            <div class="py-5 rounded-t-3xl bg-white shadow-t-2">
              <h5 class="text-xl font-bold text-slate-500 text-center"><?= $freeAgent['givenName'] . ' ' . $freeAgent['familyName'] ?></h5>
              <p class="mb-2 text-xs text-slate-300 text-center"><?= $freeAgent['driverTeam'] ?></p>
              <img class="w-full h-auto" src="<?= $freeAgent['teamCar'] ?>" alt="">
              <div class="flex justify-center mt-4 space-x-2 text-slate-500">
                <button class="p-1 rounded-full hover:text-blue-500 h-10 w-10" title="View Driver">
                  <i class="far fa-eye"></i>
                </button>
                <button class="p-1 rounded-full hover:text-green-500 h-10 w-10" title="Edit Driver">
                  <i class="far fa-edit"></i>
                </button>
                <button class="p-1 rounded-full text-red-300 hover:text-green-500 h-10 w-10" title="Activate Driver">
                  <i class="fas fa-times-circle"></i>
                </button>
              </div>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <!-- Background Overlay -->
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <!-- Modal Content -->
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <div class="absolute top-0 right-0 pt-4 pr-4">
          <button id="close-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
              <path d="M6.707 5.293a1 1 0 011.414 0L12 10.586l3.293-3.293a1 1 0 011.414 0l.086.086a1 1 0 010 1.414L13.414 12l3.293 3.293a1 1 0 010 1.414l-.086.086a1 1 0 01-1.414 0L12 13.414l-3.293 3.293a1 1 0 01-1.414 0l-.086-.086a1 1 0 010-1.414L10.586 12 7.293 8.707a1 1 0 010-1.414l-.086-.086z" />
            </svg>
          </button>
        </div>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <!-- Modal Content Goes Here -->
          <form class="bg-white px-8 pt-6 pb-8 mb-4">
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="driverId">
                    Driver ID
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="driverId" type="text" placeholder="hamilton" />
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="permanentNumber">
                    Permanent Number
                  </label>
                  <div class="relative">
                    <select class="block appearance-none w-full bg-white text-gray-400 border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="permanentNumber">
                      <option value="">Select a number</option>
                      <?php for ($i = 1; $i <= 100; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php endfor; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-300">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M6 8l4 4 4-4"></path>
                      </svg>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="url">
                    Profile Picture
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="url" type="text" placeholder="paste url to image" />
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="url">
                    Wiki Page
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="url" type="text" placeholder="paste link to wiki page" />
                </div>
              </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="givenName">
                    First Name
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="givenName" type="text" placeholder="Lewis" />
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="familyName">
                    Last Name
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="familyName" type="text" placeholder="Hamilton" />
                </div>
              </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="dob">
                    Date of Birth
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="dob" type="text" placeholder="YYYY-MM-DD" />
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <div class="flex">
                    <label class="block text-slate-500 font-bold mb-2 mr-2" for="url">
                      Country Flag
                    </label>
                    <a href="https://www.countryflags.com/" target="_blank" rel="noopener">
                      <i class="fas fa-external-link-alt fa-xs text-slate-500"></i>
                    </a>
                  </div>

                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-500 leading-tight focus:outline-none focus:shadow-outline" id="url" type="text" placeholder="paste flag url from" />
                </div>
              </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="driverTeam">
                    Driver Team
                  </label>
                  <div class="relative">
                    <select class="shadow appearance-none border rounded w-full py-2 px-3  text-gray-400 leading-tight focus:outline-none focus:shadow-outline" id="driverTeam">
                      <option value="">Select a team</option>
                      <?php
                      foreach ($driverTeams as $team) {
                      ?>
                        <option value="<?php echo $team; ?>"><?php echo $team; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-300">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M6 8l4 4 4-4"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="driverTeam">
                    Team Colour
                  </label>
                  <div class="relative">
                    <select class="shadow appearance-none border rounded w-full py-2 px-3  text-gray-400 leading-tight focus:outline-none focus:shadow-outline" id="driverTeam">
                      <option value="">Select a team</option>
                      <?php
                      foreach ($teamColour as $colour) {
                      ?>
                        <option value="<?php echo $colour; ?>"><?php echo $colour; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-300">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M6 8l4 4 4-4"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-4">
              <div class="w-full md:w-1/2 px-2">
                <div class="mb-4">
                  <label class="block text-slate-500 font-bold mb-2" for="teamCar">
                    Team Car
                  </label>
                  <div class="relative">
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-400 leading-tight focus:outline-none focus:shadow-outline" id="teamCar">
                      <option value="https://i.postimg.cc/hPWKVPRj/f1template-prev.jpg">Default Car</option>
                      <?php
                      foreach ($teamCars as $car) {
                      ?>
                        <option value="<?php echo $car; ?>"><?php echo $car; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-300">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M6 8l4 4 4-4"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/2 px-2 pt-6">
                <div id="teamCarImage">
                  <img src="" alt="" class="w-full h-auto">
                </div>
              </div>
            </div>
            <div class="flex justify-center">
              <div>
                <input id="activeToggle" class="mt-[0.3rem] mr-2 h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-red-500 outline-none before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-white after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-green-500 checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="flexSwitchCheckDefault">Does the driver currently have a?</label>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery Code -->
  <script>
    $(document).ready(function() {
      $("#show-modal").click(function() {
        $("#modal").removeClass("hidden");
      });

      $("#close-modal").click(function() {
        $("#modal").addClass("hidden");
      });
    });
    $(document).ready(function() {
      // Get default car image URL
      var defaultCarUrl = "https://i.postimg.cc/hPWKVPRj/f1template-prev.jpg";
      // Set initial car image to default URL
      $('#teamCarImage img').attr('src', defaultCarUrl);
      $('#teamCar').change(function() {
        var carUrl = $(this).val();
        if (carUrl === defaultCarUrl) {
          // Set car image to default URL
          $('#teamCarImage img').attr('src', defaultCarUrl);
        } else {
          // Set car image to selected option URL
          $('#teamCarImage img').attr('src', carUrl);
        }
      });
    });
    $(document).ready(function() {
      $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
      });
    });
    $(document).ready(function() {
      $('#activeToggle').change(function() {
        var isActive = $(this).prop('checked');
        // var driverId = ... // get the driver ID from somewhere
        var drivers = getDrivers();
        for (var i = 0; i < drivers.length; i++) {
          if (drivers[i].driverId === driverId) {
            drivers[i].active = isActive;
            break;
          }
        }
        saveDrivers(drivers);
      });
    });
  </script>
</body>

</html>