import { useNavigate, useParams } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { useEffect, useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { api } from "@/lib/api";
import { useToast } from "@/hooks/use-toast";
import { DatePicker } from "./custom/date-picker";

export default function EventForm() {
  const { toast } = useToast();
  const queryClient = useQueryClient();
  const { id } = useParams();
  const isEdit = !!id;
  const navigate = useNavigate();
  const [initialRegistered, setInitialRegistered] = useState(0);
  const [errors, setErrors] = useState({});

  const { data: initialData } = useQuery({
    queryKey: ["event", id],
    queryFn: () => api.get(`/events/${id}`).then((res) => res.data?.data),
    enabled: isEdit,
  });

  const mutation = useMutation({
    mutationFn: (data) =>
      isEdit ? api.patch(`/events/${id}`, data) : api.post("/events", data),
    onSuccess: () => {
      console.log("Form submitted:", formData);
      queryClient.invalidateQueries(["events"]);
      toast({ title: `Event ${isEdit ? "updated" : "created"} successfully` });
      navigate("/");
    },
    onError: () => toast({ title: "Operation failed", variant: "destructive" }),
  });

  const defaultValues = {
    title: initialData?.title || "",
    date: initialData?.date || "",
    location: initialData?.location || "",
    capacity: initialData?.capacity || 0,
    content: initialData?.content || "",
  };

  const [formData, setFormData] = useState(defaultValues);

  const handleChange = (field, value) => {
    setFormData((prev) => ({ ...prev, [field]: value }));
    setErrors((prev) => ({ ...prev, [field]: "" }));
  };

  useEffect(() => {
    if (initialData) {
      const formattedDate = new Date(initialData.date)
        .toISOString()
        .split("T")[0];
      setFormData({
        title: initialData.title,
        date: formattedDate,
        location: initialData.location,
        capacity: initialData.capacity,
        content: initialData.content,
      });
      setInitialRegistered(initialData.registered);
    }
  }, [initialData]);

  const handleSubmit = (e) => {
    e.preventDefault();
    const validationErrors = validateForm(formData, isEdit, initialRegistered);

    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      return;
    }

    mutation.mutate(formData);
  };

  const validateForm = (formData, isEdit = false, initialRegistered = 0) => {
    const errors = {};

    if (!formData.title.trim()) {
      errors.title = "Title is required";
    } else if (formData.title.length > 100) {
      errors.title = "Title must be less than 100 characters";
    }

    if (!formData.content.trim()) {
      errors.content = "Content is required";
    } else if (formData.content.length > 500) {
      errors.content = "Content must be less than 500 characters";
    }

    if (!formData.location) {
      errors.location = "Location is required";
    } else if (formData.location.length > 200) {
      errors.location = "Location must be less than 200 characters";
    }

    if (!formData.capacity) {
      errors.capacity = "Capacity is required";
    } else if (isNaN(formData.capacity)) {
      errors.capacity = "Capacity must be a number";
    } else if (formData.capacity < 1) {
      errors.capacity = "Capacity must be at least 1";
    } else if (formData.capacity > 100) {
      errors.capacity = "Capacity cannot exceed 100";
    } else if (isEdit && formData.capacity < initialRegistered) {
      errors.capacity = `Capacity cannot be less than ${initialRegistered} (current registrations)`;
    }

    if (!formData.date) {
      errors.date = "Date is required";
    }

    return errors;
  };

  return (
    <div className="p-6 mx-auto space-y-6 lg:w-[34rem]">
      <h1 className="text-2xl font-bold">
        {isEdit ? "Edit Event" : "Create New Event"}
      </h1>

      <form onSubmit={handleSubmit} className="space-y-4">
        <div className="space-y-2">
          <Label>Event Title *</Label>
          <Input
            value={formData.title}
            onChange={(e) => handleChange("title", e.target.value)}
          />
          {errors.title && (
            <p className="text-sm text-red-500">{errors.title}</p>
          )}
        </div>

        <div className="grid gap-4 md:grid-cols-2">
          <div className="space-y-2">
            <Label>Date *</Label>
            <DatePicker
              value={formData.date}
              onChange={(e) => handleChange("date", e)}
              disabled={(date) => date < new Date()}
            />
            {errors.date && (
              <p className="text-sm text-red-500">{errors.date}</p>
            )}
          </div>

          <div className="space-y-2">
            <Label>Capacity *</Label>
            <Input
              type="number"
              value={formData.capacity}
              onChange={(e) => handleChange("capacity", e.target.value)}
              min="1"
              max="100"
            />
            {errors.capacity && (
              <p className="text-sm text-red-500">{errors.capacity}</p>
            )}
          </div>
        </div>

        <div className="grid gap-4 md:grid-cols-1">
          <div className="space-y-2">
            <Label>Location *</Label>
            <Input
              value={formData.location}
              onChange={(e) => handleChange("location", e.target.value)}
            />
            {errors.location && (
              <p className="text-sm text-red-500">{errors.location}</p>
            )}
          </div>
        </div>

        <div className="space-y-2">
          <Label>Content *</Label>
          <Textarea
            value={formData.content}
            onChange={(e) => handleChange("content", e.target.value)}
            rows={4}
          />
          {errors.content && (
            <p className="text-sm text-red-500">{errors.content}</p>
          )}
        </div>

        <div className="flex justify-end gap-2">
          <Button type="button" variant="outline" onClick={() => navigate("/")}>
            Cancel
          </Button>
          <Button type="submit" disabled={mutation.isLoading}>
            {mutation.isLoading
              ? "Saving..."
              : isEdit
              ? "Save Changes"
              : "Create Event"}
          </Button>
        </div>
      </form>
    </div>
  );
}
