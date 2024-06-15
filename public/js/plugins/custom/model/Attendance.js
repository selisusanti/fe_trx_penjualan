//This Model is used on Driver Attendance

class Attendance{
    constructor(checkIn, checkOut, tripId, isAvailable){
        this.checkIn = checkIn;
        this.checkOut = checkOut;
        this.tripId = tripId;
        this.isAvailable = isAvailable;
    }
    
    getObject(){
        let data = {
            "checkIn": this.checkIn,
            "checkOut": this.checkOut,
            "tripId": this.tripId,
            "isAvailable": this.isAvailable
        };

        return data;
    }
}