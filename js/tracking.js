const express = require('express');
const app = express();
const bodyParser = require('body-parser');
app.use(bodyParser.json());

// API สำหรับเช็คสถานะพัสดุ
app.get('/track/:tracking_number', async (req, res) => {
  const trackingNumber = req.params.tracking_number;
  const shipment = await getShipmentByTrackingNumber(trackingNumber); // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล

  if (shipment) {
    res.json({
      tracking_number: shipment.tracking_number,
      status: shipment.current_status,
      location: shipment.current_location,
      last_updated: shipment.last_updated
    });
  } else {
    res.status(404).json({ message: 'Shipment not found' });
  }
});

// API สำหรับอัปเดตสถานะพัสดุ
app.post('/update-status', async (req, res) => {
  const { tracking_number, status, location } = req.body;
  const shipment = await getShipmentByTrackingNumber(tracking_number);

  if (shipment) {
    // อัปเดตสถานะในฐานข้อมูล
    await updateShipmentStatus(shipment.id, status, location); // ฟังก์ชันอัปเดตสถานะ
    res.json({ message: 'Status updated successfully' });
  } else {
    res.status(404).json({ message: 'Shipment not found' });
  }
});

function getShipmentByTrackingNumber(trackingNumber) {
  // ฟังก์ชันดึงข้อมูลจากฐานข้อมูล
  return db.query('SELECT * FROM shipments WHERE tracking_number = ?', [trackingNumber]);
}

function updateShipmentStatus(shipmentId, status, location) {
  // ฟังก์ชันอัปเดตสถานะในฐานข้อมูล
  const query = `UPDATE shipments SET current_status = ?, current_location = ?, last_updated = NOW() WHERE id = ?`;
  return db.query(query, [status, location, shipmentId]);
}

app.listen(3000, () => {
  console.log('Server running on port 3000');
});
