const seats = {
    1: {reserved: false, startTime: null, endTime: null},
    2: {reserved: false, startTime: null, endTime: null},
    3: {reserved: false, startTime: null, endTime: null},
    4: {reserved: false, startTime: null, endTime: null},
    5: {reserved: false, startTime: null, endTime: null},
    6: {reserved: false, startTime: null, endTime: null},
    7: {reserved: false, startTime: null, endTime: null},
    8: {reserved: false, startTime: null, endTime: null},
    9: {reserved: false, startTime: null, endTime: null},
    10: {reserved: false, startTime: null, endTiume: null},
};

function checkSeat() {
    const seatNumber = document.getElementById('seatNumber').value;
    const statusDiv = document.getElementById('seatStatus');
    const reservationDiv = document.getElementById('reservationForm');

    if (seats[seatNumber].reserved) {
        statusDiv.innerHTML = `座位 ${seatNumber} 已经被预约。`;
        reservationDiv.style.display = 'none';
    } else {
        statusDiv.innerHTML = `座位 ${seatNumber} 当前为空。`;
        reservationDiv.style.display = 'block';
    }
}

function reserveSeat() {
    const seatNumber = document.getElementById('seatNumber').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;

    seats[seatNumber] = {
        reserved: true,
        startTime: startTime,
        endTime: endTime
    };

    alert(`座位 ${seatNumber} 已预约成功。`);
    document.getElementById('reservationForm').style.display = 'none';

    checkSeat();
}

// check if a seat is valid
