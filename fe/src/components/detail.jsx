import { useState } from "react";
import { useParams, Link, useNavigate } from "react-router-dom";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Progress } from "@/components/ui/progress";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import CalendarIcon from "@/assets/calendar.svg";
import LocationIcon from "@/assets/location.svg";
import { useMutation, useQuery } from "@tanstack/react-query";
import { useToast } from "@/hooks/use-toast";
import { api } from "@/lib/api";
import { ConfirmModal } from "./ConfirmModal";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";

const EventDetail = () => {
  const { id } = useParams();
  const [isRegistered, setIsRegistered] = useState(false);
  const [registeredCount, setRegisteredCount] = useState(0);
  const [showRegistrationForm, setShowRegistrationForm] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    gender: "",
    email: "",
    phone: "",
  });
  const [loading, setLoading] = useState(false);
  const [isShowDeleteModal, setIsShowDeleteModal] = useState(false);
  const [errors, setErrors] = useState({});
  const [apiError, setApiError] = useState("");
  const navigate = useNavigate();

  const { toast } = useToast();

  const { data: event } = useQuery({
    queryKey: ["event", id],
    queryFn: () => api.get(`/events/${id}`).then((res) => res.data?.data),
  });

  const registerMutation = useMutation({
    mutationFn: (data) => api.post(`/events/${id}/register`, data),
    onSuccess: () => {
      toast({ title: "Registration successful!" });
      setIsRegistered(true);
      setRegisteredCount((prev) => prev + 1);
      setShowRegistrationForm(false);
      setFormData({ name: "", gender: "", email: "", phone: "" });
    },
    onError: (err) => {
      toast({ title: "Registration failed", variant: "destructive" }),
        setApiError(err.message || "Something went wrong");
    },
    finally: () => setLoading(false),
  });

  const validateForm = () => {
    const newErrors = {};
    if (!formData.name.trim()) {
      newErrors.name = "Name is required";
    } else if (formData.name.length > 20) {
      newErrors.name = "Name cannot exceed 20 characters";
    }
    if (!formData.gender) newErrors.gender = "Gender is required";
    if (!formData.email.trim()) {
      newErrors.email = "Email is required";
    } else if (!/^\S+@\S+\.\S+$/.test(formData.email)) {
      newErrors.email = "Invalid email format";
    }
    if (!formData.phone.trim()) {
      newErrors.phone = "Phone is required";
    } else if (!/^\d{10,15}$/.test(formData.phone)) {
      newErrors.phone = "Invalid phone number";
    }
    return newErrors;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const validationErrors = validateForm();
    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      return;
    }

    setLoading(true);
    setApiError("");

    registerMutation.mutate(formData);
  };

  const deleteMutation = useMutation({
    mutationFn: (id) => api.delete(`/events/${id}`),
    onSuccess: () => {
      toast({ title: "Event deleted successfully" });
      navigate("/");
    },
    onError: () => toast({ title: "Delete failed", variant: "destructive" }),
  });

  const handleInputChange = (field, value) => {
    setFormData((prev) => ({ ...prev, [field]: value }));
    setErrors((prev) => ({ ...prev, [field]: "" }));
  };

  const registrationPercentage =
    ((event?.registered + registeredCount) / event?.capacity) * 100;

  return (
    <>
      <ConfirmModal
        open={!!isShowDeleteModal}
        onOpenChange={(open) => !open && setIsShowDeleteModal(false)}
        onConfirm={() => deleteMutation.mutate(id)}
        title="Confirm Delete Event"
        description="This will permanently delete the event and all its registrations."
        confirmText="Delete"
      />
      <div className="max-w-4xl p-4 mx-auto lg:w-[50rem]">
        {showRegistrationForm && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
            <Card className="w-full max-w-md">
              <CardContent className="p-6 space-y-4">
                <h2 className="text-2xl font-bold">Event Registration</h2>

                <form onSubmit={handleSubmit} className="space-y-4">
                  <div>
                    <Label>Full Name *</Label>
                    <Input
                      value={formData.name}
                      onChange={(e) =>
                        handleInputChange("name", e.target.value)
                      }
                      disabled={loading}
                    />
                    {errors.name && (
                      <p className="text-sm text-red-500">{errors.name}</p>
                    )}
                  </div>

                  <div>
                    <Label>Gender *</Label>
                    <RadioGroup
                      defaultValue={formData.gender}
                      onValueChange={(value) => {
                        console.log(value);
                        return handleInputChange("gender", value);
                      }}
                    >
                      <div className="flex items-center space-x-2">
                        <RadioGroupItem
                          value="male"
                          id="male"
                          className="p-0"
                        />
                        <Label htmlFor="male">Male</Label>
                      </div>
                      <div className="flex items-center space-x-2">
                        <RadioGroupItem
                          value="female"
                          id="female"
                          className="p-0"
                        />
                        <Label htmlFor="female">Female</Label>
                      </div>
                      <div className="flex items-center space-x-2">
                        <RadioGroupItem
                          value="unspecified"
                          id="unspecified"
                          className="p-0"
                        />
                        <Label htmlFor="unspecified">Unspecified</Label>
                      </div>
                    </RadioGroup>
                    {/* <Select
                      value={formData.gender}
                      onValueChange={(value) =>
                        handleInputChange("gender", value)
                      }
                      disabled={loading}
                    >
                      <SelectTrigger>
                        <SelectValue placeholder="Select gender" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="male">Male</SelectItem>
                        <SelectItem value="female">Female</SelectItem>
                        <SelectItem value="unspecified">Unspecified</SelectItem>
                      </SelectContent>
                    </Select> */}
                    {errors.gender && (
                      <p className="text-sm text-red-500">{errors.gender}</p>
                    )}
                  </div>

                  <div>
                    <Label>Email *</Label>
                    <Input
                      type="email"
                      value={formData.email}
                      onChange={(e) =>
                        handleInputChange("email", e.target.value)
                      }
                      disabled={loading}
                    />
                    {errors.email && (
                      <p className="text-sm text-red-500">{errors.email}</p>
                    )}
                  </div>

                  <div>
                    <Label>Phone Number *</Label>
                    <Input
                      type="tel"
                      value={formData.phone}
                      onChange={(e) =>
                        handleInputChange("phone", e.target.value)
                      }
                      disabled={loading}
                    />
                    {errors.phone && (
                      <p className="text-sm text-red-500">{errors.phone}</p>
                    )}
                  </div>

                  {apiError && (
                    <p className="text-sm text-red-500">{apiError}</p>
                  )}

                  <div className="flex justify-end gap-2">
                    <Button
                      type="button"
                      variant="outline"
                      onClick={() => setShowRegistrationForm(false)}
                      disabled={loading}
                    >
                      Cancel
                    </Button>
                    <Button type="submit" disabled={loading}>
                      {loading ? "Submitting..." : "Register"}
                    </Button>
                  </div>
                </form>
              </CardContent>
            </Card>
          </div>
        )}

        <Card>
          <CardHeader>
            <div className="flex items-start justify-between">
              <CardTitle className="text-3xl">{event?.title}</CardTitle>
              <Link to="/">
                <Button variant="outline">← Back to Events</Button>
              </Link>
            </div>
          </CardHeader>

          <CardContent>
            <div className="grid gap-8 md:grid-cols-2">
              <div className="space-y-4">
                <div className="flex items-center gap-2">
                  <img src={CalendarIcon} alt="calendar" className="w-5 h-5" />
                  <p>{event?.date}</p>
                </div>

                <div className="flex items-center gap-2">
                  <img src={LocationIcon} alt="location" className="w-5 h-5" />
                  <p className="font-medium">{event?.location}</p>
                </div>

                <div className="pt-4 border-t">
                  <h3 className="mb-2 text-lg font-semibold">
                    Event Description
                  </h3>
                  <p className="text-gray-600 dark:text-gray-300">
                    {event?.content}
                  </p>
                </div>
              </div>

              <div className="space-y-6">
                <Card className="bg-muted/50">
                  <CardContent className="p-6 space-y-4">
                    <h3 className="text-xl font-semibold">
                      Registration Status
                    </h3>

                    <div className="space-y-2">
                      <div className="flex justify-between text-sm">
                        <span>
                          Registered: {event?.registered + registeredCount}
                        </span>
                        <span>Capacity: {event?.capacity}</span>
                      </div>
                      <Progress
                        value={registrationPercentage}
                        className="h-2"
                      />
                    </div>

                    <Button
                      className="w-full"
                      size="lg"
                      onClick={() => setShowRegistrationForm(true)}
                      disabled={
                        isRegistered ||
                        event?.registered + registeredCount >= event?.capacity
                      }
                    >
                      {isRegistered
                        ? "Registered ✓"
                        : event?.registered + registeredCount >= event?.capacity
                        ? "Event Full"
                        : "Register Now"}
                    </Button>

                    {event?.registered + registeredCount >= event?.capacity && (
                      <p className="text-sm text-center text-red-500">
                        This event has reached full capacity
                      </p>
                    )}
                  </CardContent>
                </Card>
              </div>
              <Button
                className="w-full"
                size="sm"
                variant="destructive"
                onClick={() => setIsShowDeleteModal(true)}
              >
                Delete
              </Button>
              <Button
                className="w-full"
                size="sm"
                onClick={(e) => {
                  e.stopPropagation();
                  navigate(`/event/${event.id}/edit`);
                }}
              >
                Edit
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>
    </>
  );
};

export default EventDetail;
