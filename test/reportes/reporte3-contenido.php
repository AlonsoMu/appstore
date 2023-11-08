<page>
  <h1 class="fs-5 text-center text-bold">Bienvenidos a SENATI</h1>
  <h3 class="mt-3 mb-3 text-center text-italic">Desarrollado por <?= $desarrollador ?></h3>

  <p class="mb-3 text-justify">
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum alias sit numquam est iure tempora voluptatem laudantium odio deleniti, incidunt omnis ea corrupti praesentium sed nemo beatae exercitationem ex debitis.
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum alias sit numquam est iure tempora voluptatem laudantium odio deleniti, incidunt omnis ea corrupti praesentium sed nemo beatae exercitationem ex debitis.
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum alias sit numquam est iure tempora voluptatem laudantium odio deleniti, incidunt omnis ea corrupti praesentium sed nemo beatae exercitationem ex debitis.
  </p>

  <table class="table ">
    <colgroup>
      <col style="width: 50%">
      <col style="width: 50%">
    </colgroup>
    <thead>
      <tr class="bg-primary text-light">
        <th>Sedes</th>
        <th>Carreras</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($dataTable as $data): ?>
        <tr>
          <td><?= $data["sede"] ?></td>
          <td><?= $data["carrera"] ?></td>
          
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</page>

<page>
  <ul>
    <?php foreach($carreras as $carrera): ?>
      <li><?= $carrera ?></li>
    <?php endforeach; ?>
  </ul>
  
</page>

