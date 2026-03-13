<?php
session_start();
include("../../phpscripts/database-connection.php");
include("../../phpscripts/check-login.php");
include("../../includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Books - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="librarian">
  <!-- Header -->
  <?php include("../../components/librarian/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secBooks">
      <div class="secBooks__inner">
        <!-- Header -->
        <div class="secBooks__top">
          <div>
            <p class="secBooks__kicker animation-pulse">Library Management</p>
            <h1 class="secBooks__title animation-pulse">Books Inventory</h1>
            <p class="secBooks__sub animation-upwards">
              Manage all library books including adding, editing and tracking availability.
            </p>
          </div>
          <button class="secBooks__addBtn animation-right" data-bs-toggle="modal" data-bs-target="#bookModal">
            Add Book
          </button>
        </div>
        <!-- Table Panel -->
        <div class="secBooks__panel">
          <div class="secBooks__panelHead">
            <h2 class="secBooks__panelTitle animation-pulse">All Books</h2>
          </div>
          <div class="table-responsive animation-fadeInUp">
            <table id="booksTable" class="table table-striped align-middle secBooks__table">
              <thead>
                <tr>
                  <th class="text-center">Title</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Available</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" width="120">Actions</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- ================= BOOK MODAL ================= -->
    <div class="modal fade" id="bookModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="bookForm" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Add Book</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="book_id" id="book_id">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Author</label>
                  <input type="text" name="author" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Category</label>
                  <input type="text" name="category" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Total Copies</label>
                  <input type="number" name="total_copies" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label">Book Cover</label>
                  <input type="file" name="cover_image" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save Book</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Modal -->
  <?php include("../../components/modal.php"); ?>
  <!-- Footer -->
  <?php include("../../components/footer.php"); ?>
  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= BASE_URL ?>assets/js/librarian/books.js"></script>

</body>

</html>