import * as React from "react";
import { Calendar } from "@/components/ui/calendar";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";
import { Button } from "@/components/ui/button";
import { CalendarIcon } from "lucide-react";

export function DatePicker({ value, onChange, ...props }) {
  const [date, setDate] = React.useState(null);

  React.useEffect(() => {
    if (value) {
      setDate(new Date(value));
    }
  }, [value]);

  const handleDateChange = (newDate) => {
    if (newDate) {
      setDate(newDate);
      const formattedDate = `${newDate.getFullYear()}-${(newDate.getMonth() + 1)
        .toString()
        .padStart(2, "0")}-${newDate.getDate().toString().padStart(2, "0")}`;
      onChange(formattedDate);
    }
  };

  return (
    <Popover>
      <PopoverTrigger asChild>
        <Button variant="outline" className="justify-start w-full text-left">
          {date ? date.toISOString().split("T")[0] : "Select Date"}
          <CalendarIcon className="w-5 h-5 ml-auto opacity-50" />
        </Button>
      </PopoverTrigger>
      <PopoverContent className="w-auto p-0">
        <Calendar
          mode="single"
          selected={date instanceof Date ? date : new Date(date)}
          onSelect={handleDateChange}
          initialFocus
          {...props}
        />
      </PopoverContent>
    </Popover>
  );
}
