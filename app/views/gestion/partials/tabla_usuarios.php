<!-- Contenido de la tabla -->
<div id="tabla-resultados" class="card shadow-sm rounded-lg mt-12" style="border: 1px solid #005f2f;">
    <div id="tabla-body" class="card-body">
        <!-- Sección de tabs o bullet points -->
        <ul class="nav nav-tabs">
            <?php
            $roles = [
                'Instructor' => 'Instructores',
                'Funcionario' => 'Funcionarios',
                'Directivo' => 'Directivos',
                'Apoyo' => 'Apoyos',
                'Visitante' => 'Visitantes'
            ];
            ?>
            <?php foreach ($roles as $clave => $valor): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($rol === $clave) ? 'active' : '' ?>" 
                       href="?rol=<?= urlencode($clave) ?>">
                        <?= $valor ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Tabla de resultados -->
        <div id="resultados">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <?php if ($rol === 'Instructor'): ?>
                            <th>Curso</th>
                            <th>Ubicación</th>
                        <?php elseif ($rol === 'Funcionario'): ?>
                            <th>Área</th>
                            <th>Puesto</th>
                        <?php elseif ($rol === 'Directivo'): ?>
                            <th>Cargo</th>
                            <th>Departamento</th>
                        <?php elseif ($rol === 'Apoyo'): ?>
                            <th>Área de Trabajo</th>
                        <?php endif; ?>
                        <?php if ($rol === 'Visitante'): ?>
                            <th>Asunto</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']) ?></td>
                                <td><?= htmlspecialchars($u['numero_identidad']) ?></td>

                                <?php if ($rol === 'Instructor'): ?>
                                    <td><?= htmlspecialchars($u['curso'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($u['ubicacion'] ?? '') ?></td>
                                <?php elseif ($rol === 'Funcionario'): ?>
                                    <td><?= htmlspecialchars($u['area'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($u['puesto'] ?? '') ?></td>
                                <?php elseif ($rol === 'Directivo'): ?>
                                    <td><?= htmlspecialchars($u['cargo'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($u['departamento'] ?? '') ?></td>
                                <?php elseif ($rol === 'Apoyo'): ?>
                                    <td><?= htmlspecialchars($u['area_trabajo'] ?? '') ?></td>
                                <?php endif; ?>
                                <?php if ($rol === 'Visitante'): ?>
                                    <td><?= htmlspecialchars($u['asunto'] ?? '') ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= $numColumnas ?>" class="text-center">No hay usuarios en esta categoría.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Controles de paginación -->
        <nav aria-label="Paginación">
            <ul class="pagination justify-content-center">
                <!-- Botón "Anterior" -->
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?rol=<?= urlencode($rol) ?>&page=<?= $page - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                <?php endif; ?>

                <!-- Números de página -->
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?rol=<?= urlencode($rol) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Botón "Siguiente" -->
                <?php if ($page < $totalPaginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?rol=<?= urlencode($rol) ?>&page=<?= $page + 1 ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>